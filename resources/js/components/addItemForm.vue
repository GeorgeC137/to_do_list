<template>
  <div class="addItem">
    <input type="text" v-model="item.name" />

    <font-awesome-icon
      icon="plus-square"
      :class="[item.name ? 'active' : 'inactive', 'plus']"
      @click="addItem"
    />
  </div>
  <div>
    <transition
      name="alert-in"
      enter-active-class="animated flipInX"
      leave-active-class="animated flipOutX"
    >
      <p class="alert" v-if="v$.item.name.$error">
        {{ v$.item.name.$errors[0].$message }}
      </p>
    </transition>
  </div>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import { required, minLength } from "@vuelidate/validators";

export default {
  name: "addItemForm",
  data() {
    return {
      v$: useVuelidate(),
      item: {
        name: "",
      },
    };
  },
  methods: {
    addItem(e) {
      e.preventDefault();

      this.v$.$validate();
      if (!this.v$.$error) {
        axios
          .post("api/item/store", {
            item: this.item,
          })
          .then((response) => {
            if (response.status == 201) {
              this.item.name = "";
              this.$emit("reload-list");
            }
          });
      }
    },
  },
  validations() {
    return {
      item: {
        name: { required, minLength: minLength(4) },
      },
    };
  },
};
</script>

<style scoped>
@import "https://cdn.jsdelivr.net/npm/animate.css@3.5.1";

.addItem {
  display: flex;
  justify-content: center;
  align-items: center;
}

input {
  background: #f7f7f7;
  margin-right: 10px;
  border: 0px;
  outline: none;
  padding: 5px;
  width: 100%;
}

.plus {
  font-size: 20px;
  cursor: pointer;
}

.active {
  color: green;
}

.inactive {
  color: #999999;
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

p {
  text-align: center;
  padding: 30px 0;
  color: gray;
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
