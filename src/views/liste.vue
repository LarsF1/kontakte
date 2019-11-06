<template>
  <table class="tstacked">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Vorname</th>
                <th>Strasse</th>
                <th>PLZ</th>
                <th>Ort</th>
                <th>Email</th>
                <th>Telefon privat</th>
                <th>Telefon gesch.</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="element in data" :key="element.kid">
                <td data-label="Loeschen">
                  <a href="#" @click="deleteKontakt(element)"><font-awesome-icon icon="trash" /></a>
                </td>
                <td data-label="Name">{{ element.name }}</td>
                <td data-label="Vorname">{{ element.vorname }}</td>
                <td data-label="Strasse">{{ element.strasse }}</td>
                <td data-label="PLZ">{{ element.plz }}</td>
                <td data-label="Ort">{{ element.ort }}</td>
                <td data-label="Email">{{ element.email }}</td>
                <td data-label="Telefon privat">{{ element.tpriv }}</td>
                <td data-label="Telefon gesch.">{{ element.tgesch }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
      data(){
        return {
          data:[]
        }
      },
      mounted(){
        this.axios.post('/api/index.php',
          {
              id: 'liste',
              func: 'lesen'
          }
        ).then(response => {
          this.data = response.data.data;
          console.log(response.data);
        })
        .catch(error => {
          console.log(error);
        });
      },
      methods: {
          deleteKontakt(element){
            console.log(element);
          }
      },
      computed: {
          checkData() {
            return this.data.length;
          }
      }
    }
</script>