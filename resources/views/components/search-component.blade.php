  <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between">
      <input type="text" name="name" placeholder="Search..." class="row-cols-md-3 ">
      <select name="status" id="" class="form-control">
          <option value="">all</option>
          <option value="active">active</option>
          <option value="inactive">inactive</option>
      </select>
      <button type="submit" class="btn btn-primary">Search</button>
  </form>
