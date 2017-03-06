@extends('layouts.default')
@section('title', '用户信息')
@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <table class="table">
      <thead>
        <tr>
          <th>用户类型</th>
          <th>用户名</th>
          <th>ID</th>
          <th>最近一次登录时间</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            @if (Auth::user()->is_admin)
              管理员
            @else
              普通用户
            @endif
          </td>
          <td>{{ Auth::user()->name }}</td>
          <td>{{ Auth::user()->email }}</td>
          <td>2017-03-01 00:00   (<a href="#">点击查看最近八次登录情况</a>)</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@stop
