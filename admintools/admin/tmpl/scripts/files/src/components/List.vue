<template>

  <div class="">

    <table class="si-table si-table-style-firstLeft">
      <thead>
        <tr>
          <th>Exist</th>
          <th v-on:click="handlerSort('timestamp')" class="curser">Datum</th>
          <th v-on:click="handlerSort('name')" class="curser">Titel</th>
          <th v-on:click="handlerSort('size')" class="curser">Size</th>
          <th v-on:click="handlerSort('ext')" class="curser">Ext</th>
          <th v-on:click="handlerSort('mime')" class="curser">Mime</th>
          <th>Path</th>
          <th>Benutzer</th>
        </tr>
      </thead>
      <tbody>
        <tr v-bind:key="index" v-for="(item, index) in  sortedArray">
          <td><span v-if="item.exist == false" class="text-red"><i class="far fa-exclamation-triangle"></i></span></td>
          <td class="">{{item.time}}</td>
          <td class="">{{item.name}}</td>
          <td class="">{{item.size}}</td>
          <td class="">{{item.ext}}</td>
          <td class="">{{item.mime}}</td>
          <td class="">{{item.path}}</td>
          <td><User v-if="item.user" v-bind:data="item.user" v-bind:size="'line'"></User></td>
        </tr>
      </tbody>
    </table>


  </div>

</template>


<script>

import User from './../mixins/User.vue'

export default {
  components: {
    User
  },
  name: 'List',
  props: {
    items: Array
  },
  data(){
    return {
      sort: {
        column: false,
        order: true
      }
    }
  },
  computed: {
    sortedArray: function() {
      //console.log('sortedArray',this.sort.column,this.sort.order);
      if (this.sort.column) {
        if (this.sort.order) {
          //return this.items.sort((a, b) => a.id - b.id );
          //return this.items.slice().sort((a, b) => a[this.sort.column] - b[this.sort.column] );
          return this.items.sort((a, b) => a[this.sort.column].localeCompare(b[this.sort.column]))
        } else {
          //return this.items.slice().sort((a, b) => b[this.sort.column] - a[this.sort.column] );
          return this.items.sort((a, b) => b[this.sort.column].localeCompare(a[this.sort.column]))
        }
      }
      return this.items.sort((a, b) => a.name - b.name );
    }
  },
  created: function () {
  },
  mounted() {
  },
  methods: {

    handlerSort: function (column) {
      if (column) {
        this.sort.column = column;
        if (this.sort.order) {
          this.sort.order = false;
        } else {
          this.sort.order = true;
        }
      }
    }

  }
}
</script>
