<template>
  <div id="app">
      <menu-header></menu-header>
    <router-view />
  </div>
</template>

<script>
import Menu from "./components/Menu.vue";

export default {
    components:{
        menuHeader: Menu
    }
}
</script>
