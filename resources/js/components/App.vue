<template>
  <div class="todoListContainer">
    <div class="heading">
      <h2 id="title">To Do List</h2>
      <addItemForm @reload-list="getList" />
    </div>

    <listView :items="items" @reload-list="getList" />
  </div>
</template>

<script>
import addItemForm from "./addItemForm.vue";
import listView from "./listView.vue";

export default {
  name: "App",
  components: {
    addItemForm,
    listView,
  },
  data() {
    return {
      items: [],
    };
  },
  methods: {
    getList() {
      axios
        .get("api/items")
        .then((response) => {
          this.items = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getList();
  },
};
</script>

<style scoped>
.todoListContainer {
  width: 350px;
  margin: auto;
}

.heading {
  background: #e6e6e6;
  padding: 10px;
}

#title {
  text-align: center;
}
</style>
