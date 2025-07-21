// Animate vote bars when they come into view
document.addEventListener('DOMContentLoaded', function() {
// Animate vote bars
    setTimeout(function() {
        const voteFills = document.querySelectorAll('.vote-fill');
            voteFills.forEach(fill => {
                const width = fill.getAttribute('data-width');
                fill.style.width = width + '%';
            });
        }, 500);
            
// Add rank numbers to result cards
const resultCards = document.querySelectorAll('.result-card');
    resultCards.forEach((card, index) => {
        const rankEl = card.querySelector('.result-rank');
                
        if (rankEl) {
            if (index === 0) {
                rankEl.innerHTML = '<i class="fas fa-crown"></i>';
                rankEl.classList.add('rank-first');
                } else {
                    rankEl.textContent = index + 1;
                }
            }
                
                // Add animation with delay based on index
                setTimeout(() => {
                    card.classList.add('animated');
                }, 100 * index);
            });
            
        // Load comments
        loadComments();
    });
        
// Function to load comments via AJAX
function loadComments() {
    const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById('comments-container').innerHTML = this.responseText;
                    
                // Add animation to comments
                const comments = document.querySelectorAll('.comment');
                comments.forEach((comment, index) => {
                    setTimeout(() => {
                        comment.classList.add('animated');
                    }, 100 * index);
                });
            }
        };
    xhr.open('GET', 'getComments.php', true);
    xhr.send();
}