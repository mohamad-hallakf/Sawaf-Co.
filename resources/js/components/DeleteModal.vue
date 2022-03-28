<template>
  <div>
    <b-row  align-h="center" class="mt-4">
      <b-col   >
        <b-button variant="danger" @click="removeCustomerFromData"
          >Ok</b-button
        >
            <b-button variant="info" class="text-white" @click="triggerClose">Cancel</b-button>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "DeleteCustomerModal",
  props: {
    productId: Number,
  },
  methods: {
    triggerClose() {
      this.$emit("closeDeleteModal");
    },
    removeCustomerFromData() {
      axios
        .post(`/api/product/destroy/${this.productId}`)
        .then(() => {
          this.$emit("reloadDataTable");
          this.$emit("showDeleteAlert");
          this.$emit("closeDeleteModal");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
