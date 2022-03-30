<template>
  <div>

    <b-row align-h="center" class="mt-4">
      <b-col>
        <b-button variant="danger" @click="removeProductrFromData">Ok</b-button>
        <b-button variant="info" class="text-white" @click="triggerClose"
          >Cancel</b-button
        >
      </b-col>
    </b-row>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "DeleteProductrModal",
  props: {
    itemId: Number,
    itemType:String
  },
  methods: {
    triggerClose() {
      this.$emit("closeDeleteModal");
    },
    removeProductrFromData() {
      axios
        .post(`/api/${this.itemType}/destroy/${this.itemId}`)
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
<style scoped>
header button{
    background-color: transparent;
    border: none;
    font-size: 25px;

}
</style>
