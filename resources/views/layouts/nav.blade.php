<nav class="navbar navbar-toggleable-md navbar-inverse bg-nav fixed-top">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ route('home')}}">
    <i class="fa fa-home text-white"></i>
    {{ company()->name}}
  </a>
  <div class="collapse navbar-collapse justify-content-end mr-3">
    <ul class="navbar-nav">
      <li class="nav-item ">
       <a class="nav-link" href="{{ route('reports') }}">
          <i class="fa fa-bar-chart"></i>
         Reports
        </a>
     </li>
   
     <li class="nav-item ">
      <a class="nav-link" href="{{ route('items.index') }}">
        <i class="fa fa-balance-scale"></i>
        Items
        </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="{{ route('accomodation') }}">
        <i class="fa fa-university"></i>
        Accomodation
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('parking') }}">
        <i class="fa fa-bus"></i>
         Parking
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('otherIncomes.index') }}">
        <i class="fa fa-globe"></i>
        Other Incomes
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('employees.index') }}">
            <i class="fa fa-users"></i>
          Employees
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ route('expenditures.index') }}">
        <i class="fa fa-shopping-bag"></i>
         Expenditure
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link " href="{{ route('configuration') }}">
        <i class="fa fa-cog"></i>
        Configuration
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ route('logout') }}">
        <i class="fa fa-sign-out"></i>
        Logout
      </a>
    </li>
  </ul>
</div>
</nav>
