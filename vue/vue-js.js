new Vue({
    el: '#cronjobs',
    data: {
      partialKey1: '',
      partialKey2: '',
      jobname: '',
      showDeleteMsgBox: false,
      removeDeletedEntry: false
    },
    // syncronous functions run here
    computed: {
      computedFuncName: function() {

      }
    },
    // asyncronous functions are run here
    watch: {
      dataPropToWatch: function() {

      }
    },
    // basic functions are run here
    methods: {
      // use this to delete jobs and remove element from page
      stageDelete: function(pk1, pk2) {
        this.jobname = pk1;
        this.partialKey1 = '';
        this.partialKey2 = '';
        this.partialKey1 = pk1;
        this.partialKey2 = pk2;
        // show message box and set values to THIS.valName
        this.showDeleteMsgBox = true;
      },

      confirmDelete: function() {
        let payload = {
          keys: [this.partialKey1, this.partialKey2]
        };
        // send data received off to php file to make the deletion
        axios.post('/delete-cron-row.php', {
          data: payload
        })
        .then(function (response) {
          // try to remove element from page..
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
        this.showDeleteMsgBox = false;
      },

      dismissDelete: function() {
        this.partialKey1 = '';
        this.partialKey2 = '';
        this.showDeleteMsgBox = false;
      }
    }
  });
