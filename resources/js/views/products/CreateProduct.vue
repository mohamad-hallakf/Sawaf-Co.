<template>
  <div>
    <PageNav pageName="Create Product">
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
      <product-form
        action="create"
        @showSuccessAlert="showAlertCreate"
      ></product-form>
    </div>
  </div>
</template>
<script>
import PageNav from "../../components/PageNav.vue";
import ProductForm from "../../components/ProductForm.vue";

export default {
  components: { PageNav, ProductForm },
  methods: {
    showAlertCreate() {
      this.showSuccessAlert = true;
      this.alertMessage = "Product was created successfully!";
    },
    back() {
      this.$router.push({ path: "/product" });
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
