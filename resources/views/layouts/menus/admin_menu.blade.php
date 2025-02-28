<li class="nav-item">
    <a class="nav-link active" href="{{ route('dashboard') }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="nav-icon fas fa-users"></i>
        <p>Users <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('users.info') }}" class="nav-link">
                <i class="nav-icon fas fa-arrow-circle-righ"></i>
                <p>Manage Users</p>
            </a>
        </li>
    </ul>
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
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <p>Catalogue <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('catalogue.info') }}">
                <i class="nav-icon fas fa"></i>
                <p>Manage Catalogue</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-box-open"></i>
        <p>Products <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.add_product') }}">
                <i class="nav-icon fas fa"></i>
                <p>Add Product</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.info') }}">
                <i class="nav-icon fas fa"></i>
                <p>Manage Product</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-folder-open"></i>
        <p>System Reports <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('report.sales') }}">
                <i class="nav-icon fas fa"></i>
                <p>Sales Reports</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('report.stock') }}">
                <i class="nav-icon fas fa"></i>
                <p>Stock List</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cog"></i>
        <p>Settings <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('setting.supplier') }}">
                <i class="nav-icon fas fa"></i>
                <p>Suppliers</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('setting.slide') }}">
                <i class="nav-icon fas fa"></i>
                <p>Slides</p>
            </a>
        </li>
    </ul>
</li>