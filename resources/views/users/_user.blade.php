<li>
  <span>ID：{{ $user->email }}</span>
  <br /><br />
  <span>用户名：{{ $user->name }}</span>
  @can('destroy', $user)
    <form action="{{ route('users.destroy', $user->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
    </form>
    <form action="{{ route('users.edit', $user->id) }}" method="get">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-sm btn-warning modify-btn">修改密码</button>
    </form>
  @endcan
  @can('create', $user)
    <form action="{{ route('users.create') }}" method="get">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-sm btn-success create-btn">新建用户</button>
    </form>
  @endcan
</li>
