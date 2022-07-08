# -*- coding: utf-8 -*-
"""
Created on Sun Jun 19 13:21:17 2022

@author: User
"""

import numpy as np
import pandas as pd
from pathlib import Path
import os.path
import matplotlib.pyplot as plt
import tensorflow as tf
# from tensorflow.keras.preprocessing.image import load_img, img_to_array
from keras.preprocessing.image import ImageDataGenerator
print(tf.__version__)


# Create a list with the filepaths for training and testing
train_dir = Path(
    'C://xampp/htdocs/pantaudayaid/image classification/Dataset PJU/train')
train_filepaths = list(train_dir.glob(r'**/*.jpg'))

# print(train_filepaths)


test_dir = Path(
    'C://xampp/htdocs/pantaudayaid/image classification/Dataset PJU/test')
test_filepaths = list(test_dir.glob(r'**/*.jpg'))


val_dir = Path(
    'C://xampp/htdocs/pantaudayaid/image classification/Dataset PJU/validation')
val_filepaths = list(test_dir.glob(r'**/*.jpg'))


#try_split  = str(train_filepaths[1])
#print("filepath_str :", try_split)
#splitting = try_split.split("/")


#print("filepaths : ", splitting)

#split2 = str(try_split).split("\\")
# print(split2[1])


def image_processing(filepath):
    """ Create a DataFrame with the filepath and the labels of the pictures
    """

    labels = [str(filepath[i]).split("\\")[7]
              for i in range(len(filepath))]
    #print("file", filepath)

    # print(labels)
   # print("label", labels)

    filepath = pd.Series(filepath, name='Filepath').astype(str)
    labels = pd.Series(labels, name='Label')

    #print("label", labels)
    #print("filepath", filepath)

    # Concatenate filepaths and labels
    df = pd.concat([filepath, labels], axis=1)
    print("dataframe", df)

    # Shuffle the DataFrame and reset index
    df = df.sample(frac=1).reset_index(drop=True)

    print("dataframe", df)

    return df


train_df = image_processing(train_filepaths)
test_df = image_processing(test_filepaths)
val_df = image_processing(val_filepaths)
#print("cetak train_df",train_df)

#print("train df :",train_df)


#print('-- Training set --\n')
#print(f'Number of pictures: {train_df.shape[0]}\n')
#print(f'Number of different labels: {len(train_df.Label.unique())}\n')
#print(f'Labels: {train_df.Label.unique()}')


train_df.head(5)


# Create a DataFrame with one Label of each category
df_unique = train_df.copy().drop_duplicates(subset=["Label"]).reset_index()

# print(df_unique)

# Display some pictures of the dataset
fig, axes = plt.subplots(nrows=3, ncols=2, figsize=(8, 7),
                         subplot_kw={'xticks': [], 'yticks': []})

for i, ax in enumerate(axes.flat):
    ax.imshow(plt.imread(df_unique.Filepath[i]))
    ax.set_title(df_unique.Label[i], fontsize=12)
plt.tight_layout(pad=0.5)
plt.show()


train_generator = ImageDataGenerator(
    preprocessing_function=tf.keras.applications.mobilenet_v2.preprocess_input
)


test_generator = ImageDataGenerator(
    preprocessing_function=tf.keras.applications.mobilenet_v2.preprocess_input
)


train_images = train_generator.flow_from_dataframe(
    dataframe=train_df,
    x_col='Filepath',
    y_col='Label',
    target_size=(224, 224),
    color_mode='rgb',
    class_mode='categorical',
    batch_size=32,
    shuffle=True,
    seed=0,
    rotation_range=30,
    zoom_range=0.15,
    width_shift_range=0.2,
    height_shift_range=0.2,
    shear_range=0.15,
    horizontal_flip=True,
    fill_mode="nearest"
)

# print(train_images)


val_images = train_generator.flow_from_dataframe(
    dataframe=val_df,
    x_col='Filepath',
    y_col='Label',
    target_size=(224, 224),
    color_mode='rgb',
    class_mode='categorical',
    batch_size=32,
    shuffle=True,
    seed=0,
    rotation_range=30,
    zoom_range=0.15,
    width_shift_range=0.2,
    height_shift_range=0.2,
    shear_range=0.15,
    horizontal_flip=True,
    fill_mode="nearest"
)


test_images = test_generator.flow_from_dataframe(
    dataframe=test_df,
    x_col='Filepath',
    y_col='Label',
    target_size=(224, 224),
    color_mode='rgb',
    class_mode='categorical',
    batch_size=32,
    shuffle=False
)


pretrained_model = tf.keras.applications.MobileNetV2(
    input_shape=(224, 224, 3),
    include_top=False,
    weights='imagenet',
    pooling='avg'
)
pretrained_model.trainable = False


inputs = pretrained_model.input

x = tf.keras.layers.Dense(128, activation='relu')(pretrained_model.output)
x = tf.keras.layers.Dense(128, activation='relu')(x)

outputs = tf.keras.layers.Dense(6, activation='softmax')(x)

model = tf.keras.Model(inputs=inputs, outputs=outputs)

model.compile(
    optimizer='adam',
    loss='categorical_crossentropy',
    metrics=['accuracy']
)


history = model.fit(train_images,
                    validation_data=val_images,
                    batch_size=32,
                    epochs=10,
                    callbacks=[
                        tf.keras.callbacks.EarlyStopping(
                            monitor='val_loss',
                            patience=2,
                            restore_best_weights=True)
                    ]
                    )


# Predict the label of the test_images
pred = model.predict(test_images)
pred = np.argmax(pred, axis=1)
# Map the label
labels = (train_images.class_indices)
labels = dict((v, k) for k, v in labels.items())
pred1 = [labels[k] for k in pred]
pred1


def output(location):
    img = tf.keras.preprocessing.image.load_img(
        location, target_size=(224, 224, 3))
    img = tf.keras.utils.img_to_array(img)
    img = img/255
    img = np.expand_dims(img, [0])
    answer = model.predict(img)
    y_class = answer.argmax(axis=-1)
    y = " ".join(str(x) for x in y_class)
    y = int(y)
    res = labels[y]
    return res


img = output(
    'C://xampp/htdocs/pantaudayaid/assets/Dataset PJU/deteksi gambar/Dataset PJU/test/90 W/Gambar_1.jpg')
img


model.save('datasetpju2.h5')
