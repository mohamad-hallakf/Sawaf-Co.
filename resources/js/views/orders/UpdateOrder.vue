<template>
  <div>
    <PageNav pageName="Update Order">
      ><b-button variant="success" @click="back()">
        <b-icon
          icon="box-arrow-in-right"
          aria-hidden="true"
          class="back-icon"
        ></b-icon>
      </b-button>
    </PageNav>
    <b-row>
      <b-alert
        v-model="showSuccessAlert"
        variant="success"
        dismissible
        class="px-5"
      >
        <h5>
          {{ alertMessage }}
        </h5>
      </b-alert>
    </b-row>
    <div class="m-5 shadow p-4">
      <order-form
        action="update"
        @showSuccessAlert="showAlertCreate"
      ></order-form>
    </div>
  </div>
</template>
<script>
import PageNav from "../../components/PageNav.vue";
import OrderForm from "../../components/OrderForm.vue";

export default {
  components: { PageNav, OrderForm },
  methods: {
    showAlertCreate() {
      this.showSuccessAlert = true;
      this.alertMessage = "Order was updated successfully!";
    },
    back() {
      this.$router.push({ path: "/order" });
    },
  },
  data() {
    return {
      alertMessage: "",
      showSuccessAlert: false,
    };
  },
};
</script>
