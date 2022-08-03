 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="index.html">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link" href="{{ route('unit.index') }}">
             <i class="fas fa-fw fa-car"></i>
             <span>Unit</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('transaction.index') }}">
             <i class="fas fa-fw fa-file-invoice"></i>
             <span>Transaksi Peminjaman</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('transaction.getListTransaction') }}">
             <i class="fas fa-fw fa-file-invoice"></i>
             <span>Data Peminjaman</span></a>
     </li>
     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->
