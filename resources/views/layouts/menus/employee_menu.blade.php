<li class="nav-item">
    <a class="nav-link active" href="{{ route('dashboard') }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>Point of Sale <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pos.make_sale') }}">
                <i class="nav-icon fas fa"></i>
                <p>Make sale</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pos.sales') }}">
                <i class="nav-icon fas fa"></i>
                <p>Manage Sales</p>
            </a>
        </li>
    </ul>
</li>