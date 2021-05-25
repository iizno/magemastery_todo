 define([
     'uiComponent',
     'jquery',
     'Magento_Ui/js/modal/confirm'
 ], function(Component, $, modal) {
    'use strict';
    return Component.extend({
        defaults: {
            button_selector: '#add-new-task-button',
            new_task_label: 'Something todo !',
            tasks: [
                {id: 1, label: "Task 1", status: false},
                {id: 2, label: "Task 2", status: false},
                {id: 3, label: "Task 3", status: false},
                {id: 4, label: "Task 4", status: true},
            ]
        },
        initObservable: function() {
            this._super().observe([
                'tasks',
                'new_task_label'
            ]);
            return this;
        },
        switchStatus: function (data, event) {
            const task_id = $(event.target).data('id');
            var items = this.tasks().map(function(task) {
                if(task.id === task_id) {
                    task.status = !task.status;
                }

                return task;
            });

            return this.tasks(items);
        },
        deleteTask: function (task_id) {

            var self = this;

            modal({
               content: 'Are you sure you want to delete the task ?',
               actions: {
                   confirm: function() {
                       var tasks = [];

                       if(self.tasks.length === 1) {
                           self.tasks(tasks);
                           return;
                       }

                       self.tasks().forEach(function (task) {
                           if (task.id !== task_id) {
                               tasks.push(task);
                           }
                       })

                       self.tasks(tasks);
                   }
               }
            });
        },
        addTask: function() {
            this.tasks.push(
                {
                    id: Math.floor(Math.random() * 100),
                    label: this.new_task_label(),
                    status: false
                }
            )
            this.new_task_label('');
        },
        checkKey: function(data, event) {
            if(event.keyCode === 13) {
                event.preventDefault();
                $(this.button_selector).click();
            }
        },
    });
});
