$(document).ready(function() {
    // Real-time comment submission and display
    $('#comment-form').submit(function(event) {
        event.preventDefault();
        const taskId = $('#task-id').val();
        const commentText = $('#comment-text').val();

        $.ajax({
            url: '/task/comment',
            type: 'POST',
            data: {
                task_id: taskId,
                comment: commentText
            },
            success: function(response) {
                if (response.success) {
                    // Append the new comment to the comments list
                    $('#comments-list').append(`
                        <div class="comment">
                            <p>${response.comment.text}</p>
                            <small>Por: ${response.comment.user_name} em ${response.comment.created_at}</small>
                        </div>
                    `);
                    $('#comment-text').val(''); // Clear the textarea
                } else {
                    alert('Erro ao enviar o comentário.');
                }
            }
        });
    });

    // Fetch and display notifications in real-time
    function fetchNotifications() {
        $.ajax({
            url: '/notifications',
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const notifications = response.notifications;
                    $('#notifications-count').text(notifications.length);

                    let notificationsList = '';
                    notifications.forEach(function(notification) {
                        notificationsList += `
                            <div class="notification">
                                <p>${notification.message}</p>
                                <small>${notification.timestamp}</small>
                            </div>
                        `;
                    });
                    $('#notifications-list').html(notificationsList);
                }
            }
        });
    }

    // Set interval to fetch notifications every 30 seconds
    setInterval(fetchNotifications, 30000);

    // Initial fetch of notifications
    fetchNotifications();

    // Task status update
    $('.task-status').change(function() {
        const taskId = $(this).data('task-id');
        const newStatus = $(this).val();

        $.ajax({
            url: '/task/update_status',
            type: 'POST',
            data: {
                task_id: taskId,
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    alert('Status da tarefa atualizado com sucesso.');
                } else {
                    alert('Erro ao atualizar o status da tarefa.');
                }
            }
        });
    });

    // Real-time project progress display
    function fetchProjectProgress() {
        const projectId = $('#project-id').val();
        
        $.ajax({
            url: `/project/progress?project_id=${projectId}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const progress = response.progress;
                    $('#progress-bar').css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');
                }
            }
        });
    }

    // Set interval to fetch project progress every 60 seconds
    setInterval(fetchProjectProgress, 60000);

    // Initial fetch of project progress
    fetchProjectProgress();
});

document.addEventListener('DOMContentLoaded', (event) => {
    console.log('Document fully loaded and parsed');
    // Coloque aqui sua lógica de JavaScript personalizada, como interações de UI
});
