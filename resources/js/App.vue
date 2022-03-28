<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="#">sawaftech</b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item href="#"
            ><router-link to="/" class="link">Home</router-link>
          </b-nav-item>
          <b-nav-item href="#">
            <router-link to="/product" class="link">List Products</router-link>
          </b-nav-item>

        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <transition name="slide" mode="out-in">
    <router-view />
    </transition>
  </div>
</template>
<style >
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
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
.slide-enter-active,.slide-leave-active{
transition: opacity 0.5s,transform 0.5s;
}
.slide-enter,.slide-leave-to{
    opacity: 0;
    transform: translateX(-20%);
}
</style>

