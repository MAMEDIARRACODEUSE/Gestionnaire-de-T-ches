document.addEventListener("DOMContentLoaded", function () {
    const taskList = document.getElementById("task-list");
    const newTaskInput = document.getElementById("new-task");
    const addButton = document.getElementById("add-button");

    addButton.addEventListener("click", function () {
        const taskText = newTaskInput.value.trim();
        if (taskText !== "") {
            addTask(taskText);
            newTaskInput.value = "";
        }
    });

    function addTask(taskText) {
        const task = document.createElement("div");
        task.classList.add("task");
        task.innerHTML = `
            <input type="checkbox">
            <label>${taskText}</label>
            <button class="delete-button">Supprimer</button>
        `;

        const deleteButton = task.querySelector(".delete-button");
        deleteButton.addEventListener("click", function () {
            taskList.removeChild(task);
        });

        taskList.appendChild(task);
    }
});
