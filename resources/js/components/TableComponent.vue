<script setup>
import { defineProps, onMounted, ref } from 'vue';

defineProps({
    title: String,
    th1: String,
    th2: String,
    th3: String,
    th4: String,
    th5: String,
    data: Array,
});

const companiestable = ref(false);

onMounted(() => {
  if (url === '/companies') {
    companiestable.value = true;
  }
});
</script>

<template>
  <div v-if="companiestable">
    <h1 class="title">{{ title }}</h1>
    <div id="rectangle"></div>
    <div class="container">
      <table v-if="data.length > 0">
        <thead>
          <th>{{ th1 }}</th>
          <th>{{ th2 }}</th>
          <th>{{ th3 }}</th>
          <th>{{ th4 }}</th>
          <th>{{ th5 }}</th>
        </thead>
        <tbody>
          <tr v-for="item in data" :key="item.id">
            <router-link class="link" :to="{ name: 'Company', params: { id: item.id } }">
              <td class="td1">{{ item.name }}</td>
            </router-link>
            <td class="td2">{{ item.tva }}</td>
            <td class="td1">{{ item.country }}</td>
            <td class="td1">{{ item.type_id }}</td>
            <td class="td1">{{ item.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
