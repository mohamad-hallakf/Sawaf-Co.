<template>
  <div>
    <PageNav pageName="List Products"
      ><b-button variant="success" @click="navigate()"> Create Product   <b-icon-plus-circle-fill class="text-white my-auto"></b-icon-plus-circle-fill > </b-button>
    </PageNav>

    <div class="m-5 shadow p-4">
      <data-table></data-table>
    </div>




  </div>
</template>
<script>
import PageNav from "../../components/PageNav.vue";
import DataTable from "../../components/ProductTable.vue";
export default {
  components: { PageNav ,DataTable},


  methods: {
    navigate() {
      this.$router.push({ path: "/create-product" });
    },
  },
  data() {
    return {

    };
  },
};
</script>
