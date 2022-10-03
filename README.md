# CRAGenerator
Generates customer risk assessments (CRAs)

## 0. Intro

For this project I hope to implement Domain Driven Design architecture and SOLID principles. The scripts generate risk assessments for each customer based on their identity and trade data. Data is currently stored in CSV files but will eventually be migrated onto a database.  

All the system currently does is run tests that instantiate Customers from the CSV rows and then injects each Customer's historic trades into their $trades property.

## 1. Domains

#### 1.1. Customers

Properties represent the identity data for each customer. They are also assigned an array of their Trades and their Risk Assessments. Their risk assessments will eventually be viewable via HTML generated by the UserInterface Layer.

#### 1.2. Trades (effectively "orders" or "purchases/sales")

Properties represent transcational data. Each trade contains its corresponding Payment.

#### 1.3. Payments (actual money transfers) [not yet implemented]

Mapped from the transaction data of each payment.

#### 1.4. (Risk) Assessments [not yet implemented]

A series of risk scores generated for each customer from all of the above data.

## 2. Layers (within each domain)

### 2.1. Core Layer

#### 2.1.1. BusinessLogic ("domain" or "model" layer)

Within each domain the BusinessLogic folder contains the model class, its factory, and any "horizontal" cross-domain services for the models to interact with other models (e.g. The FetchCustomerTradesService represents the Customer domain interacting with the Trade domain).

### 2.2. Application Layers

#### 2.2.1. UserInterface ("client" or "presentation" layer) [not yet implemented]

Classes for user interactions and any services for interacting with the BusinessLogic core.

#### 2.2.2. DataAccess ("persistence" layer)

Classes for reading/writing from the CSV files and any services for interacting with the BusinessLogic core. Currently this includes a DTO class and adapters (repositories?) for converting data in different CSVs into a universal DTO that is used to build the BusinessLogic layer's model properties.

#### 2.2.3. Testing

Contains a test service file for testing the domain's classes and methods.

## 3. Infrastructure

This folder contains any "horizontal" cross-domain interfaces or services that are not restricted to a single domain.

