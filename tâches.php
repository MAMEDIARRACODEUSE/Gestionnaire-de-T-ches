<?php
// Fonction pour récupérer la liste des tâches depuis un fichier JSON
function getTasks() {
    $filename = 'tasks.json';
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        return json_decode($data, true);
    }
    return [];
}

// Fonction pour sauvegarder la liste des tâches dans un fichier JSON
function saveTasks($tasks) {
    $filename = 'tasks.json';
    $data = json_encode($tasks);
    file_put_contents($filename, $data);
}

$tasks = getTasks();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $taskText = $_POST['task'];
            if ($taskText !== "") {
                $task = [
                    'text' => $taskText,
                    'completed' => false
                ];
                array_push($tasks, $task);
                saveTasks($tasks);
                echo '<div class="task">';
                echo '<input type="checkbox">';
                echo '<label>' . htmlspecialchars($taskText) . '</label>';
                echo '<button class="delete-button">Supprimer</button>';
                echo '</div>';
                exit();
            }
        } elseif ($_POST['action'] === 'delete') {
            $taskIndex = $_POST['index'];
            if (isset($tasks[$taskIndex])) {
                array_splice($tasks, $taskIndex, 1);
                saveTasks($tasks);
                exit();
            }
        }
    }
}

foreach ($tasks as $index => $task) {
    $taskText = htmlspecialchars($task['text']);
    $completed = $task['completed'] ? 'checked' : '';
    echo '<div class="task">';
    echo '<input type="checkbox" ' . $completed . '>';
    echo '<label>' . $taskText . '</label>';
    echo '<button class="delete-button">Supprimer</button>';
    echo '</div>';
}
?>
