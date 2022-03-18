<div class="sidebar-container fixed-top">
  {{-- <div class="sidebar-logo">
    <h4>IoT Dashboard</h4> <p style="font-size: 12px; margin-bottom: 0 ">For Putra Future Classroom</p>
  </div> --}}
  <nav>
    <ul class="list-unstyled components sidebar-navigation" id="sidenav">
      <li class="header">Navigation</li>
      <li class="">
        <a href="/">
          <i class="fa fa-home" aria-hidden="true"></i> Homepage
        </a>
      </li>
      <li>
        <a href="/devices">
          <i class="fa fa-tachometer" aria-hidden="true"></i> IoT Devices
        </a>
      </li>
      <li class="header">Settings</li>
      <li>
        <a href="#sensor" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fa fa-cog"></i> Sensors</a>
        <ul class="collapse list-unstyled" id="sensor">
          <li>
            <a href="/sensors">Manage Sensor</a>
          </li>
          <li>
            <a href="/sensorType">Sensor Types</a>
          </li>

        </ul>
      </li>

      <li>
        <a href="#actuator" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fa fa-cog" aria-hidden="true"></i> Actuators
        </a>
        <ul class="collapse list-unstyled" id="actuator">
          <li>
            <a href="/actuators">Manage Actuator</a>
          </li>
          <li>
            <a href="/actuatorType">Actuator Types</a>
          </li>

        </ul>
      </li>
      <li>
        <a href="/scripts">
          <i class="fa fa-info-circle" aria-hidden="true"></i> Manage Scripts
        </a>
      </li>
    </ul>
  </nav>
</div>






{{-- 
<div class="bg-light border-right" id="sidebar-wrapper">
  <div class="sidebar-heading"><b>Iot Dashboard</b> </div>
  
  
  <div class="list-group list-group-flush">
    <a href="/" class="list-group-item list-group-item-action bg-light">RPI Home</a>
    <a href="/light" class="list-group-item list-group-item-action bg-light">Lighting</a>
    <a href="/temperature" class="list-group-item list-group-item-action bg-light">Temperature</a>
    <a href="{{ route('sensorType.index') }}" aria-expanded="false" class="list-group-item list-group-item-action
bg-light">Sensor Types</a>


<a href="{{ route('actuatorType.index') }}" class="dropdown-toggle list-group-item list-group-item-action bg-light"
  data-toggle="collapse" aria-expanded="false">Actuators Types</a>
<a href="{{ route('actuators.index') }}" class="list-group-item list-group-item-action bg-light">Actuators
  Setting</a>
<a href="{{ route('sensors.index') }}" class="list-group-item list-group-item-action bg-light">Sensors Setting</a>

</div>
</div> --}}