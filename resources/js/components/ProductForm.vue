<template>
  <b-row align-h="center" class="mx-auto">
    <b-form class="col-8" @submit="onSubmit">
      <b-row>
        <b-row>
          <h4 v-if="action==`update`" class="text-secondary">Update Product</h4>
          <h4 v-else class="text-secondary">Create Product</h4>
        </b-row>
        <b-col>
          <b-form-group label="Product Name" label-for="product-name">
            <b-form-input
              id="product-name"
              type="text"
              placeholder="Product Name"
              required
              v-model="product.productname"
              :state="ProductNameState"
            ></b-form-input>
            <b-form-invalid-feedback id="input-live-feedback">
              Product Name is Requirde
            </b-form-invalid-feedback>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="mt-3">
        <b-col>
          <b-form-group label="Unit Price" label-for="unit-price">
            <b-form-input
              id="unit-price"
              type="number"
              required
              placeholder=" "
              v-model="product.unitprice"
              :state="unitState"
              requird
            ></b-form-input>
            <b-form-invalid-feedback id="iunit-price-feedback">
              Unir Price is Requirde
            </b-form-invalid-feedback>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="mt-3">
        <b-col>
          <label for="supplier-id" />Choose Company Name
          <select
            class="form-select"
            id="supplier-id"
            v-model="product.supplier_id"
            required
          >
            <option value="" disabled>-- Please select an option --</option>

            <option v-for="op in options" :key="op.id" :value="op.id">
              {{ op.companyname }}
            </option>
          </select>
        </b-col>
      </b-row>
      <b-row align-h="center" class="mt-4">
        <b-button
          variant="primary"
          type="submit"
          class="px-5 mx-auto w-50"

          >Save</b-button
        >
      </b-row>
    </b-form>

  </b-row>
</template>

<script>
import axios from "axios";
export default {

  name: "CreateCustomerModal",
  props:['action'],
  created() {
    axios
      .get("/api/product/getAllSuppliers")
      .then((response) => {
        this.options = response.data.data;
      })
      .catch((error) => {
        console.log(error);
      });
      if(this.action=="update"){
            axios
      .post("/api/product/edit/"+this.$route.params.id +"")
      .then((response) => {
        let products = response.data.data;
           this.product.productname=products.productname
        this.product.unitprice=products.unitprice
        this.product.supplier_id=products.supplier_id
      })
      .catch((error) => {
        console.log(error);
      });
      }


  },
  computed: {
    ProductNameState() {
      return this.product.productname.length > 0 ? true : false;
    },
    unitState() {
      return this.product.unitprice.length > 0 ? true : false;
    },
  },
  data() {
    return {
      product: {
        productname: "",
        unitprice: "",
        supplier_id: "",
      },
      options: [],

    };
  },
  methods: {

    onSubmit(event) {
               event.preventDefault()
               let action=this.action
                if(this.action=="update"){
         axios.post("/api/product/update/"+this.$route.params.id+"", this.product)
        .then((response) => {
          if(response.data.response){
          this.$emit("showSuccessAlert");
    this.resetForm()
          }
        })
        .catch((error) => {
          console.log(error);
        });
                }else
        axios
        .post("/api/product/store", this.product)
        .then((response) => {
          if(response.data.response){
          this.$emit("showSuccessAlert");
    this.resetForm()
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    resetForm(){
        this.product.productname=''
        this.product.unitprice=''
        this.product.supplier_id=""
    }
  },
};
</script>
