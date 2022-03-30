<template>
  <div>
    <b-row>
    <b-alert v-model="showSuccessAlert" variant="success"  dismissible  class="px-5">
           <h5  >
 {{ alertMessage }}
          </h5>
      </b-alert>
    </b-row>
    <b-row class="mt-3">
      <b-card>
        <b-row class="mt-3">
          <b-table
            striped
            hover
            :items="items"
            :fields="fields"
            class="text-center"
          >
            <template #cell(product_name)="data">
              {{ `${data.item.productname} ` }}
            </template>
            <template #cell(supplier_id)="data">
              {{ `${data.item.suppliers.companyname} ` }}
            </template>
            <template #cell(unit_price)="data">
              {{ `${data.item.unitprice} ` }}
            </template>

            <template #cell(actions)="data">
              <b-row>
                <b-col >
                  <b-button
                    variant="outline-primary"
                    @click="goToUpdatePage(data.item.id)"
                  >
                    Modify</b-button
                  >
                               <b-button
                    variant="outline-danger"
                                 @click="showDeleteModal(data.item.id)"
                  >
                    Delete</b-button
                  >
                </b-col>

              </b-row>
            </template>
          </b-table>
        </b-row>
      </b-card>
    </b-row>

    <!-- Delete Productr Modal -->
    <b-modal
      ref="delete-product-modal"
      size="md"
      hide-footer
      title="Confirm Deletion"
    >
      <DeleteProductrModal
        @closeDeleteModal="closeDeleteModal"
        @reloadDataTable="getProductrData"
        @showDeleteAlert="showDeleteSuccessModal"
        :itemId="productId"
        itemType="product"
      ></DeleteProductrModal>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
import DeleteProductrModal from "./DeleteModal.vue";

export default {
  components: {
    DeleteProductrModal,
  },
  data() {
    return {
      fields: [
        {
          key: "product_name",
          label: "Product Name",
          sortable: false,
        },
        {
          key: "supplier_id",
          label: "Company Name",
          sortable: false,
        },
        {
          key: "unit_price",
          label: "Unit Price",
          sortable: false,
        },

        "actions",
      ],
      items: [],
      numberOfProductrs: 0,
      productId: 0,
      companySearchTerm: "",
      showSuccessAlert: false,
      alertMessage: "",
    };
  },
  mounted() {
    this.getProductrData();
  },
  methods: {
    getProductrData() {
      axios
        .get("/api/product/")
        .then((response) => {
          this.items = response.data.data;
          this.numberOfProductrs = response.data.data.length;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    goToUpdatePage(id) {
       this.$router.push({ path: "/update-product/"+id+"" });
    },

    showDeleteModal(id) {
      this.$refs["delete-product-modal"].show();
      this.productId = id;
    },
    closeDeleteModal() {
      this.$refs["delete-product-modal"].hide();
    },
    showDeleteSuccessModal() {
      this.showSuccessAlert = true;
      this.alertMessage = "Productr was deleted successfully!";
    },
  },
};
</script>

<style>
</style>
