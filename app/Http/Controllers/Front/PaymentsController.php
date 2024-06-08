<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
        // $order = Order::where('user_id', Auth::user()->id)->findOrFail($order->id);
        return view('front.payments', ['order' => $order]);
    }

    public function store(Order $order)
    {
        try {
            // $order = Order::where('user_id', Auth::user()->id)->findOrFail($order->id);
            $amount = $order->items->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            // Ensure the amount is converted to cents
            $amountInCents =  $amount * 100;

            Log::info('Calculated Amount: ' . $amount);

            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $intent = $stripe->paymentIntents->create([
                'amount' => $amountInCents, // amount in cents
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            Log::info('Payment Intent Created: ' . json_encode($intent));

            return response()->json([
                'client_secret' => $intent->client_secret,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating PaymentIntent: ' . $e->getMessage());

            return response()->json([
                'error' => 'Unable to create PaymentIntent'
            ], 500);
        }
    }



    public function return(Request $request, Order $order)
    {
        // Verify the payment intent parameter is present
        if (!$request->has('payment_intent')) {
            return redirect()->route('payments.create', $order->id)->with('error', 'Payment intent not provided.');
        }

        // Fetch the order for the authenticated user
        $order = Order::findOrFail($order->id);

        // Initialize Stripe client
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            // Retrieve the payment intent
            $paymentIntent = $stripe->paymentIntents->retrieve($request->payment_intent, []);

            // Check the payment intent status
            if ($paymentIntent->status == 'succeeded') {
                $order->status = 'completed';
                $order->payment_status = 'paid';
                $order->payment_method = $paymentIntent->payment_method;
                $order->save();

                return redirect()->route('home')->with('success', 'Payment successful.');
            } else {
                $order->status = 'failed';
                $order->payment_status = 'failed';
                $order->save();
                return redirect()->route('payments.create', $order)->with('error', 'Payment failed.');
            }
        } catch (\Exception $e) {
            // Log any errors for debugging
            Log::error('Error retrieving payment intent: ' . $e->getMessage());

            return redirect()->route('payments.create', $order)->with('error', 'An error occurred while processing your payment.');
        }
    }
}