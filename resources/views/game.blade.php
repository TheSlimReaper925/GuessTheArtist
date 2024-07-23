@include('layouts.header')

<div>
    <div class="header-container">
        <img id="question-image" src="" alt="Background Image" class="background-image">
        <div class="header">
            <span class="line"></span>
            <span class="header-text">გამოიცანი მხატვარი</span>
            <span class="line"></span>
        </div>
    </div>
    <div class="button-container">
        <div class="button-row">
            <button class="custom-button" id="answer-0">
            </button>
            <button class="custom-button" id="answer-1">
            </button>
        </div>
        <div class="button-row">
            <button class="custom-button" id="answer-2">
            </button>
            <button class="custom-button" id="answer-3">
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentQuestionIndex = 0;
        let questions = [];
        let correctAnswersCount = 0;

        function updateQuestion(index) {
            const question = questions[index];
            if (!question) return; // No question found, exit function

            // Set the image source
            document.getElementById('question-image').src = '/assets/images/' + question.filename;
            console.log('Displaying question:', question.filename);

            // Set the answer buttons' text
            question.answers.forEach((answer, idx) => {
                const button = document.getElementById(`answer-${idx}`);
                button.textContent = answer;
                button.style.backgroundColor = ''; // Reset background color
                button.disabled = false; // Enable button
            });
        }

        function handleAnswerClick(event) {
            const selectedIndex = parseInt(event.target.id.split('-')[1], 10);
            console.log('Answer clicked:', selectedIndex);

            const question = questions[currentQuestionIndex];
            const correctIndex = question.correct_answer;

            // Disable all buttons and show the correct/incorrect colors
            question.answers.forEach((_, idx) => {
                const button = document.getElementById(`answer-${idx}`);
                if (idx === correctIndex) {
                    button.style.backgroundColor = 'green'; // Correct answer
                } else if (idx === selectedIndex) {
                    button.style.backgroundColor = 'red'; // Selected answer
                }
                button.disabled = true; // Disable all buttons after selection
            });

            // Update correct answers counter if the selected answer is correct
            if (selectedIndex === correctIndex) {
                correctAnswersCount++;
                console.log('Correct answer count:', correctAnswersCount);
            }

            // Move to the next question after 3 seconds
            setTimeout(() => {
                if (currentQuestionIndex < questions.length - 1) {
                    currentQuestionIndex++;
                    console.log('Moving to question index:', currentQuestionIndex);
                    updateQuestion(currentQuestionIndex);
                } else {
                    window.location.href = `/score/${correctAnswersCount}`;
                }
            }, 3000);
        }

        // Event delegation for handling answer clicks
        document.querySelector('.button-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('custom-button')) {
                handleAnswerClick(event);
            }
        });

        fetch('/getQuestions')
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    questions = data;
                    updateQuestion(currentQuestionIndex);
                }
            })
            .catch(error => console.error('Error fetching questions:', error));
    });
</script>


@include('layouts.footer')
