        // Candidate selection effect
        const radioButtons = document.querySelectorAll('input[type="radio"][name="candidate_id"]');
        const counter = document.querySelector('.candidate-counter span');
        
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove selected class from all cards
                document.querySelectorAll('.candidate-card').forEach(card => {
                    card.classList.remove('selected');
                });
                
                // Add selected class to current card
                if (this.checked) {
                    this.parentElement.classList.add('selected');
                    counter.textContent = "1";
                    
                    // Animate counter
                    counter.parentElement.classList.add('pulse');
                    setTimeout(() => {
                        counter.parentElement.classList.remove('pulse');
                    }, 500);
                } else {
                    counter.textContent = "0";
                }
            });
        });
        
        // Form validation
        const voteForm = document.getElementById('voteForm');
        voteForm.addEventListener('submit', function(e) {
            const voterName = document.getElementById('voter_name').value.trim();
            const voterEmail = document.getElementById('voter_email').value.trim();
            const candidateSelected = document.querySelector('input[name="candidate_id"]:checked');
            
            if (!voterName || !voterEmail || !candidateSelected) {
                e.preventDefault();
                alert('Please fill in all required fields and select a candidate.');
                return false;
            }
            
            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(voterEmail)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return false;
            }
        });