@extends('layouts.default')
@section('title', '用户信息')
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <table class="table">
      <thead>
        <tr>
          <th>用户名</th>
          <th>ID</th>
          <th>最近一次登录时间</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ Auth::user()->name }}</td>
          <td>{{ Auth::user()->email }}</td>
          <td>2017-03-01 00:00   (<a href="#">点击查看最近八次登录情况</a>)</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@stop
