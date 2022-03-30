<template>
  <div>
    <PageNav pageName="Create Order"> </PageNav>
        <b-row>
    <b-alert v-model="showSuccessAlert" variant="success"  dismissible  class="px-5">
           <h5  >
 {{ alertMessage }}
          </h5>
      </b-alert>
    </b-row>
    <div class="m-5 shadow p-4">

  <order-form action="create"
        @showSuccessAlert="showAlertCreate"
      ></order-form>
    </div>
  </div>
</template>
<script>
import PageNav from "../../components/PageNav.vue";
import OrderForm from "../../components/OrderForm.vue";

export default {
  components: { PageNav ,OrderForm},
   methods: {showAlertCreate() {
      this.showSuccessAlert = true;
      this.alertMessage = "Order was created successfully!";
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
