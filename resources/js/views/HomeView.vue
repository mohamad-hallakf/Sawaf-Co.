<template>
<div>
    <PageNav pageName="Welcome to Home Page">
    </PageNav>
       <div class="m-5 shadow p-4">
             <b-img center  src="../../images/sawaf-logo.png" fluid alt="Responsive image"></b-img>

     </div>

</div>


</template>

<script>
import PageNav from "../components/PageNav.vue";

export default {
  components: { PageNav },
  name: 'HomeView',
}
</script>
