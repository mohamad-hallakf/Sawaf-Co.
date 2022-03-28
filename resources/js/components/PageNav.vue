<template>
  <nav class="row bg-gray shadow">
         <div class="col-10 px-4"> <h4 class=" float-left green ">{{pageName}}</h4></div>
         <div class="col-2 float-right"><slot/></div>


  </nav>
</template>

<script>
export default {
    name:'PageNav',
    props:{pageName:String}
}
</script>

<style scooped>
.bg-gray{
    background-color: #343a40;
}
.green{
      color: #23a066;
}
.float-right{
    float: right;
}

</style>
