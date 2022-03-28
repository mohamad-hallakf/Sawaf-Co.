<template>
  <div>
    <PageNav pageName="Create Product"> </PageNav>
        <b-row>
      <b-alert v-model="showSuccessAlert" variant="success"  dismissible  >
        {{ alertMessage }}
      </b-alert>
    </b-row>
    <div class="m-5 shadow p-4">

  <product-form action="create"
        @showSuccessAlert="showAlertCreate"
      ></product-form>
    </div>
  </div>
</template>
<script>
import PageNav from "../components/PageNav.vue";
import ProductForm from "../components/ProductForm.vue";

export default {
  components: { PageNav ,ProductForm},
   methods: {showAlertCreate() {
      this.showSuccessAlert = true;
      this.alertMessage = "Customer was created successfully!";
    },
    },
    data(){
        return{
              alertMessage: "",
              showSuccessAlert:false
        }
    }
};
</script>
