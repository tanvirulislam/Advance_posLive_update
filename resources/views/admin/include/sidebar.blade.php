<div id="SideNavID" class="sideNavClose mt-5">
   @if(Request::is('admin*'))
    <a class="nav-menu-item" href="{{ route('admin.dashboard') }}" data-toggle="tooltip" data-placement="bottom" title="Dashboard" style="padding: 10px;font-size:16px;"><i class="fa m-2 fa-home"></i><span class="menuText d-none">Dashboard</span></a><br>
    <a class="nav-menu-item" href="{{route('admin.product')}}" data-toggle="tooltip" data-placement="bottom" title="Product" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none">Product</span></a><br>
    <a class="nav-menu-item" href="{{route('admin.sale-pos')}}" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none" data-toggle="tooltip" data-placement="bottom" title="Pos Sell">Pos Sell</span></a><br>

    <a class="nav-menu-item" href="#" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none" data-toggle="tooltip" data-placement="bottom" title="Sell List">Sell List</span></a><br>

    <a class="nav-menu-item" href="#" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none" data-toggle="tooltip" data-placement="bottom" title="Return Sell List">Return Sell List</span></a><br>

     <a class="nav-menu-item" href="{{route('admin.purchase')}}" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none" data-toggle="tooltip" data-placement="bottom" title="Purchase List">Purchase</span></a><br>


     <a class="nav-menu-item" href="#" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none" data-toggle="tooltip" data-placement="bottom" title="Expense">Expense</span></a><br>



     <a class="nav-menu-item" href="#" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none" data-toggle="tooltip" data-placement="bottom" title="People">People</span></a><br>


     <a class="nav-menu-item" href="#" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none" data-toggle="tooltip" data-placement="bottom" title="Report">Report</span></a><br>


     <a class="nav-menu-item" href="#" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-tag"></i><span class="menuText d-none" data-toggle="tooltip" data-placement="bottom" title="System Setting">System</span></a><br>

    <a class="nav-menu-item" href="#" style="padding: 10px;font-size:16px;"><i class="fas m-2 fa-cogs"></i><span class="menuText d-none">Settings</span></a><br>
        @endif
        @if(Request::is('user*'))


        @endif

</div>

<div id="ContentOverlayID"  class="ContentOverlayClose">
</div>


















