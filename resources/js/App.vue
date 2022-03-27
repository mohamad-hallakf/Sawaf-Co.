<template>
  <div id="p">
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="#">sawaftech</b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item href="#"
            ><router-link to="/" class="link">Home</router-link>
          </b-nav-item>
          <b-nav-item href="#">
            <router-link to="/about" class="link">About</router-link>
          </b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <router-view />
  </div>
</template>
<style >
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  text-decoration: none;
}

a.router-link-exact-active {
  color: #42b983;
  text-decoration: none;
  padding-bottom: 18px;
  border-bottom: 3px #42b983 solid;
}

.link {
  color: beige;
}
.link:hover {
  color: #42b983;
}
</style>
