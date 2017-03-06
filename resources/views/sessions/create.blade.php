@extends('layouts.default')
@section('title', '登录')

@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>登录页</h5>
    </div>
    <div class="panel-body">
      @include('shared.errors')

      <form id="signin" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <input id="id-number" type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="账号">
          </div>

          <div class="form-group">
            <input id="id-passwd" type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="密码">
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="remember"> 记住我</label>
          </div>

          <button type="submit" class="btn btn-primary">登录</button>
      </form>
    </div>
  </div>
</div>
@stop
