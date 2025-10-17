from flask import Flask, render_template, request
import pickle
import numpy as np

app = Flask(__name__)

# Home route
@app.route('/')
def career():
    return render_template("hometest.html")

# Prediction route
@app.route('/predict', methods=['POST'])
def result():
    if request.method == 'POST':
        # Get form data
        res = request.form.to_dict(flat=True)

        # Convert all values to float
        arr = [float(value) for value in res.values()]

        # Convert to numpy array (1 row, n features)
        data = np.array(arr).reshape(1, -1)

        # Load the trained model
        loaded_model = pickle.load(open("careerlast.pkl", 'rb'))

        # Make prediction
        predictions = loaded_model.predict(data)
        pred_probs = loaded_model.predict_proba(data)

        # Keep only probabilities > 0.05
        pred_flags = pred_probs > 0.05

        res_map = {}
        final_res = {}
        index = 0
        for j in range(17):
            if pred_flags[0, j]:
                res_map[index] = j
                index += 1

        # Filter out the main prediction
        index = 0
        for key, values in res_map.items():
            if values != predictions[0]:
                final_res[index] = values
                index += 1

        # Job dictionary
        jobs_dict = {
            0: 'AI ML Specialist',
            1: 'API Integration Specialist',
            2: 'Application Support Engineer',
            3: 'Business Analyst',
            4: 'Customer Service Executive',
            5: 'Cyber Security Specialist',
            6: 'Data Scientist',
            7: 'Database Administrator',
            8: 'Graphics Designer',
            9: 'Hardware Engineer',
            10: 'Helpdesk Engineer',
            11: 'Information Security Specialist',
            12: 'Networking Engineer',
            13: 'Project Manager',
            14: 'Software Developer',
            15: 'Software Tester',
            16: 'Technical Writer'
        }

        # Main predicted job
        main_job = predictions[0]

        return render_template(
            "testafter.html",
            final_res=final_res,
            job_dict=jobs_dict,
            job0=main_job
        )

if __name__ == '__main__':
    app.run(debug=True, port=5000)
