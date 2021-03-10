<nav class="navbar shadow-sm fixed-top navbar-light" style="background-color: darkslategray;">
  <div class="container-fluid">
    <a id="NavMenuBar" class="navbar-brand nabMenuBar" href="#"><i class="fa fa-bars" style="margin-top:-21px;"></i> </a>
    <a style="margin-inline-start: auto;margin-top: -14px;color: white;" id="" class="navbar-brand" href="{{route('admin.stock.lowStockProduct')}}" title="{{$lowStock}} products are in low stock">
      <i class="fa fa-exclamation-triangle"  style="font-size: 20px;"></i>
      <span class="warning-btn">{{$lowStock}}</span>
    </a>
    <ul>
      <li class="nav-item dropdown" style="list-style: none;">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="left: -116px;">
          <a class="dropdown-item" href="#" style="padding: 5px;"><span><i class="far fa-user"></i></span><span style="padding-left: 5px;font-size: 14px;">kajol</span></a>
          <a class="dropdown-item" href="#" style="padding: 5px;"><span><i class="far fa-id-badge"></i></span><span style="padding-left: 5px;font-size: 14px;">Profile</span></a>
          <a class="dropdown-item" href="#" style="padding: 5px;"><span><i class="fas fa-sign-out-alt"></i></span><span style="padding-left: 5px;font-size: 14px;">Logout</span></a>
        </div>
      </li>
    </ul>
  </div>
</nav>