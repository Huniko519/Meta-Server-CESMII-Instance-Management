<!-- Sidebar -->
<template>
  <div id="sidebar-wrapper">
    <div id="company-section" class="company">
      <img class="company-img"/>
      <h3>Company Name</h3>
      <router-link to="/" class="ff-montserrat">Add details</router-link> 
    </div>
    <ul id="sidebar" class="sidebar-nav text-white">
      <li class="active">
        <router-link to="/organizations">Organizations</router-link>
      </li>
      <li class="">
        <router-link to="/vms">VMs</router-link>
      </li>
      <li class="">
        <router-link to="/instances">Instances</router-link>
      </li>
      <li class="">
        <router-link to="/products">Products</router-link>
      </li>
    </ul>
  </div>
</template>