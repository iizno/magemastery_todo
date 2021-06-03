 define([
     'uiComponent',
     'jquery',
     'Magento_Ui/js/modal/confirm',
     'MageMastery_Todo/js/service/task',
     'MageMastery_Todo/js/model/loader',
 ], function(Component, $, modal, taskService, loader) {
    'use strict';
    return Component.extend({
        defaults: {
            button_selector: '#add-new-task-button',
            new_task_label: 'Something todo !',
            tasks: []
        },
        initObservable: function() {
            this._super().observe([
                'tasks',
                'new_task_label'
            ]);

            var self = this;
            taskService.getList().then(function (tasks) {
                self.tasks(tasks);
                return tasks;
            });

            return this;
        },
        switchStatus: function (data, event) {
            const task_id = $(event.target).data('id');
            var items = this.tasks().map(function(task) {
                if(task.task_id === task_id) {
                    task.status = task.status === 'open' ? 'complete' : 'open';
                    taskService.update(task_id, task.status);
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

                       taskService.delete(self.tasks().find(function (task) {
                           if(task.task_id === task_id) {
                               return task;
                           }
                       }))

                       if(self.tasks().length === 1) {
                           self.tasks(tasks);
                           return;
                       }

                       self.tasks().forEach(function (task) {
                           if (task.task_id !== task_id) {
                               tasks.push(task);
                           }
                       })

                       self.tasks(tasks);
                   }
               }
            });
        },
        addTask: function() {
            const self = this;

            var task = {
                label: this.new_task_label(),
                status: 'open',
            }

            loader.startLoader();

            taskService.create(task)
                .then(function(task_id) {
                   task.task_id = task_id;
                   self.tasks.push(task);
                   self.new_task_label('');
                }).finally(function () {
                    loader.stopLoader();
            });
        },
        checkKey: function(data, event) {
            if(event.keyCode === 13) {
                event.preventDefault();
                $(this.button_selector).click();
            }
        },
    });
});
