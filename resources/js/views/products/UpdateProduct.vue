<template>
  <div>
    <PageNav pageName="Update Product"> </PageNav>
        <b-row>
    <b-alert v-model="showSuccessAlert" variant="success"  dismissible  class="px-5">
           <h5  >
 {{ alertMessage }}
          </h5>
      </b-alert>
    </b-row>
    <div class="m-5 shadow p-4">

  <product-form action="update"
        @showSuccessAlert="showAlertCreate"
      ></product-form>
    </div>
  </div>
</template>
<script>
import PageNav from "../../components/PageNav.vue";
import ProductForm from "../../components/ProductForm.vue";

export default {
  components: { PageNav ,ProductForm},
   methods: {showAlertCreate() {
      this.showSuccessAlert = true;
      this.alertMessage = "Product was updated successfully!";
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
