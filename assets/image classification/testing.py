# -*- coding: utf-8 -*-
"""
Created on Sun Jun 19 19:14:36 2022

@author: User
"""
from unicodedata import category
from urllib import response
from PIL import Image
import tensorflow as tf
# from keras.preprocessing.image import load_img,img_to_array
import numpy as np
from keras.models import load_model
import requests
from bs4 import BeautifulSoup
from flask import Flask, jsonify, request, flash, redirect, url_for
from flask_cors import CORS
from werkzeug.utils import secure_filename
import os


app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = 'C:/xampp/htdocs/pantaudayaid/assets/image classification/upload_pju/'
CORS(app)
cors = CORS(app, resources={r"/*": {"origins": "*"}})
app.secret_key = 'super secret key'

ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg'}

pju = []
foto = []

model = load_model(
    'C:/xampp/htdocs/pantaudayaid/assets/image classification/datasetpju.h5')
labels = {0: '100 W', 1: '120 W', 2: '150 W', 3: '200 W', 4: '80 W', 5: '90 W'}

low_voltage = []
high_voltage = ['80 W', '90 W', '100 W', '120 W', '150 W', '200 W']


def processed_img(img_path):
    img = tf.keras.preprocessing.image.load_img(
        img_path, target_size=(224, 224, 3))
    img = tf.keras.utils.img_to_array(img)
    img = img/255
    img = np.expand_dims(img, [0])
    answer = model.predict(img)
    y_class = answer.argmax(axis=-1)
    print(y_class)
    y = " ".join(str(x) for x in y_class)
    y = int(y)
    res = labels[y]
    print(res)
    return res.capitalize()


def run(file):

    img_file = file
    print(img_file)
    if img_file is not None:

        save_image_path = 'C:/xampp/htdocs/pantaudayaid/assets/image classification/upload_pju/'+img_file.name
        with open(save_image_path, "wb") as f:
            f.write(img_file.getbuffer())

        # if st.button("Predict"):
        if img_file is not None:
            result = processed_img(save_image_path)
            print(result)
            if result in low_voltage:
                # st.info('**Category : High Voltage**')
                category = "Low Voltage"

            else:
                # st.info('**Category : Low Voltage**')
                category = "High Voltage"
            # st.success("**Predicted : "+result+'**')

            url = 'http://127.0.0.1:5000/login'
            myobj = {
                "category": category,
                "watt": result
            }

            requests.post(url, json=myobj)
            #cal = fetch_calories(result)
            # if cal:
            #  st.warning('**'+cal+'(100 grams)**')


def allowed_file(filename):
    return '.' in filename and \
           filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS
# languanges = [{'name' : 'Javascript'}, {'name' : 'Python'},{'name' : 'Ruby'}]


@app.route('/login', methods=['POST'])
def login():
    pjudata = {
        "category": request.json['category'],
        "watt": request.json['watt']
    }

    pju.append(pjudata)
    return jsonify({
        'pju': pju,

    })


@app.route('/got', methods=['GET'])
def coba():
    return jsonify({
        'pju': pju,

    })


@app.route('/uploader', methods=['GET', 'POST'])
def upload_file():
    if request.method == 'POST':
        # check if the post request has the file part
        if 'gambar_monitoring_pju' not in request.files:
            flash('No file part')

            return redirect(request.url)
        file = request.files['gambar_monitoring_pju']
        run(file)
        # If the user does not select a file, the browser submits an
        # empty file without a filename.
        if file.filename == '':
            flash('No selected file')
            return redirect(request.url)
        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)
            file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
            fotodata = {

                "gambar_monitoring_pju": filename

            }

            foto.append(fotodata)
            return jsonify({
                'foto': foto,

            })

    return request.files['gambar_monitoring_pju'].filename


@app.route('/foto', methods=['GET'])
def filefoto():
    return jsonify({
        'foto': foto,

    })


if __name__ == "__main__":
    app.run(debug=True)
