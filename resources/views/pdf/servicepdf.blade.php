<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
<h1>{{ $title }}</h1>
    <p>{{ $date }}</p>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
    <th scope="col">#</th>
      <th scope="col">Service</th>
      <th scope="col">Slug</th>
      <th scope="col">Image</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
   @foreach($services as $key => $value)
   <tr>
   <td>{{$key+1}}</td>
    <td>{{$value->service_name}}</td>
    <td>{{$value->slug}}</td>
    <td><img src="{{$value->image}}" width="100" height="100"></td>
    <td>{{$value->status}}</td>
   </tr>
   @endforeach
  </tbody>
</table>
</body>
</html>