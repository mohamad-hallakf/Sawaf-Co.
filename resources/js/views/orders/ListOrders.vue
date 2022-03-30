<template>
  <div>
    <PageNav pageName="List Orders"
      ><b-button variant="success" @click="navigate()"> Create Order   <b-icon-plus-circle-fill class="text-white my-auto"></b-icon-plus-circle-fill > </b-button>
    </PageNav>

    <div class="m-5 shadow p-4">
      <order-table></order-table>
    </div>




  </div>
</template>
<script>
import PageNav from "../../components/PageNav.vue";
import OrderTable from "../../components/OrderTable.vue";
export default {
  components: { PageNav ,OrderTable},


  methods: {
    navigate() {
      this.$router.push({ path: "/create-order" });
    },

  },
  data() {
    return {

    };
  },
};
</script>
