<template>
  <div>
    <transition-group
      name="list"
      enter-active-class="animated bounceInUp"
      leave-active-class="animated bounceOutDown"
    >
      <div v-for="item in items" :key="item.id">
        <listItem :item="item" class="item" @item-changed="$emit('reload-list')" />
      </div>
    </transition-group>
  </div>
</template>

<script>
import listItem from "./listItem.vue";

export default {
  name: "listView",
  components: {
    listItem,
  },
  props: {
    items: Array,
  },
};
</script>

<style>
@import "https://cdn.jsdelivr.net/npm/animate.css@3.5.1";

.item {
  background: #e6e6e6;
  padding: 5px;
  margin-top: 5px;
}

.alert {
  background: #fdf2ce;
  font-weight: bold;
  display: inline-block;
  padding: 5px;
  margin-top: -20px;
}

.alert-in-enter-active {
  animation: bounce-in 0.5s;
}

.alert-in-leave-active {
  animation: bounce-in 0.5s reverse;
}

@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}
</style>
