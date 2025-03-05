# ASTUDIO Task

## Installation & Setup
### **1. Clone the repository**
```sh
git clone https://github.com/your-repo/project-management-api.git
cd project-management-api
```

### **2. Install dependencies**
```sh
composer install
```

### **3. Configure the environment**
```sh
cp .env.example .env
```
- Set up your database connection in `.env` file.

### **4. Run database migrations & seeders**
```sh
php artisan migrate --seed
```

### **5. Generate application key**
```sh
php artisan key:generate
```

### **6. Generate Passport Client**
```sh
php artisan passport:client --personal
```

### **7. Start the server**
```sh
php artisan serve
```

---

## API Documentation

### **Full Api Documentation**
 link:https://documenter.getpostman.com/view/31408225/2sAYdmjSxn

### **Some Requests & Responses Examples**

### **Authentication**
#### **Register**
**Request:**
```http
POST /api/register
```
```json
{
  "first_name": "Mahmoud",
  "last_name": "Krima",
  "email": "mahmoudkrima2000@gmail.com",
  "password": "password"
  "password_confirmation": "password"
}
```
**Response:**
```json
{
    "data": {
        "user": {
            "id": 10,
            "first_name": "Mahmoud",
            "last_name": "Krima",
            "full_name": "Mahmoud Krima",
            "email": "mahmoudkrima2000@gmail.com"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ZTU4ZTZhMS1mZTFkLTRhMzAtYWQ5OC1hMGNiYzg0ZDQ4YmUiLCJqdGkiOiI5MjIxNDc4NDI2NmI2MTFjZjk1ZmQ2OWYyM2FjNGM4YjgxZGQ4OWVlYmM0ZGEwNmE4OTc0MDk2NTQ0ODU5YjNjNDQ3NzVmZGQ0OTZlMThjZCIsImlhdCI6MTc0MTA0NzQwNS45Njk5NTMsIm5iZiI6MTc0MTA0NzQwNS45Njk5NTYsImV4cCI6MTc3MjU4MzQwNS45NjEwNDgsInN1YiI6IjEwIiwic2NvcGVzIjpbXX0.YwCqSnG0C3pKYQ4tb8mAgDtjXJG7wtM_mrkTlD3qjMcAR_rRdYbeh3cNetFRrEF8JROWOBIFcfRIqKfmf707nx2_6dSFlDe_LbhamuYVUJ4Uq8dnMU2aw1lKUi8413w8NeObe8LprPgvxUNA3My0pL4I3bkOU6OhYoa5WTxkm5HbLtAfK-uZtx-ooZX4EKG0W04lc-qm8aTI5nGsQ4sTTRxsGVVDn1Uil_fE4LUxAEndJtCrfwZiJb5ZMpQ1Dc8P8iYpbyyhRJVUlwzupspUMweQphcTPRpczF5k6JDgLWbWqjqHzCuhJFxqq2xG7obrw7ypwCRLUp6rVKCy3my9WlNR64GLP52NIuNArBa5BlJlJeu5X25uNqywennExrpUdljnPrdGNRmAs8eH-YbGgm6hRFIxG8a91Wm1QDarLeLPfheFsvG2Prtitu46AQwRAG9zL5NlWAUWPhyyRWiDJLz9hTpOzgBA9PDiuzB6z3h-2z971AXai2JhwUKRcDUKqgQlfO1mgn9u99kN8f6Apqrgck3iMU2GulkCE7MKC8EcAsTew2z9VvOcRv8_S7klYg-5em7OMULxS-KBOUGifLds20D9tKExcf0TLDr0Im5Em2bYd_wcR_GdjA5f5k-JDCB1tgtuHDTE_3PvVm5P7FtNf6uBKafF7P0YlNpBJWg"
    },
    "message": "User registered successfully",
    "error": [],
    "status": 200
}
```

#### **Login**
**Request:**
```http
POST /api/login
```
```json
{
  "email": "mahmoudkrima2000@gmail.com",
  "password": "password"
}
```
**Response:**
```json
{
    "data": {
         "user": {
            "id": 10,
            "first_name": "Mahmoud",
            "last_name": "Krima",
            "full_name": "Mahmoud Krima",
            "email": "mahmoudkrima2000@gmail.com"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5ZTU4ZTZhMS1mZTFkLTRhMzAtYWQ5OC1hMGNiYzg0ZDQ4YmUiLCJqdGkiOiI1YjZhYTkwNGQzMzNlZTNlMTY3NjY2ZWI1MjAyYjNlMWZhMDYyYzE1MjQwZDk0ZDQyODBhMzA1OGMwYWE4MjBkMjFjMjY3NDIxYWIyNWJmNSIsImlhdCI6MTc0MTA0NzMzOC4xMTEwMTMsIm5iZiI6MTc0MTA0NzMzOC4xMTEwMTUsImV4cCI6MTc3MjU4MzMzOC4wOTY0NDYsInN1YiI6IjkiLCJzY29wZXMiOltdfQ.JR1JOcfFFbjc3zCgHrPFUAiEIvxORMV5pDmM3UVFhkpNic9WlcTW6qIvld7KKS3Eyzqib2XK_UOkIpTNWwih6NjhsAnlC1ocjAygewD3R4ErIJvviTFa8xfJS3DyjK4AvOvhbpXOYPQwxNk7MLJQVXnkdLXy7h-yASHP9wX1Vxf7RDQkzqzYbTaGlYqHGWmZchagxVH5oGtH6fte4nFdeu1X-u3iMtHvegVnrvIs8FZaQo61wHqZ0zNpeUlVadN-XvCcISmUMsaWgAfddODaLAnvBX_Uc4diMRZbCLBkDq7zRXUS_fvp984Izv3IywKA7UynSvxBP4dFREGPeVjjnoCvp1LhrXdaMmuVM-A7un09savGuNw4BkXXMJBVlw3ymLXjcm-xOawsPnDi8CS1F8vUxJVLPYqOdhKRt-FzSz2vJ0OVKzPHsJvqWkJQhZa4I-2mQapIjXtHUAzAim97leSfXFEeZbwNA1Po3yJG7aoQ4f_hkKTXVx2bW5nlcAz-xI0S2rIb6o-0vsBG_MtMf-xxVtjhSRKRbx8-5f0ZyfRf8A8L9ytGrkHZwhZtl87nhQN9we0LLwhkeKAasgzkB5Uc06gVY05sFURNsWj20v_Xk1c--h0QYkCihn_I63Y6FeGTg5_BihACCw1RIAW-I1pUqdt2lVefUNb-VZkhcUc"
    },
    "message": "User Login successfully",
    "error": [],
    "status": 200
}
```

#### **Login**
**Request:**
```http
POST /api/logout
```
```
  Authorization: Bearer your_token_here
  Content-Type: application/json
```
**Response:**
```json
{
    "data": [],
    "message": "Successfully logged out",
    "error": [],
    "status": 200
}
```

### **Projects**

#### **Filtering Projects**
**Request with Operators:**
```http
GET /api/projects?filters[start_date>=]=2025-03-06
```

**Response:**
```json
{
    "data": {
        "projects": [
            {
                "id": 1,
                "name": "Project One",
                "status": "active",
                "creator_id": 1,
                "creator_name": "Mahmoud Krima",
                "users": [
                    {
                        "id": 1,
                        "first_name": "Mahmoud",
                        "last_name": "Krima",
                        "full_name": "Mahmoud Krima",
                        "email": "modykrima2000@gmail.com"
                    }
                ],
                "attributes": [
                    {
                        "id": 1,
                        "attribute": {
                            "id": 1,
                            "name": "Department",
                            "type": "select",
                            "options": [
                                "IT",
                                "HR",
                                "Marketing"
                            ]
                        },
                        "value": "IT"
                    },
                    {
                        "id": 3,
                        "attribute": {
                            "id": 2,
                            "name": "Start Date",
                            "type": "date",
                            "options": null
                        },
                        "value": "2025-03-03"
                    },
                    {
                        "id": 4,
                        "attribute": {
                            "id": 3,
                            "name": "End Date",
                            "type": "date",
                            "options": null
                        },
                        "value": "2025-03-15"
                    }
                ]
            },
            {
                "id": 2,
                "name": "Project Two",
                "status": "pending",
                "creator_id": 2,
                "creator_name": "Krima Mahmoud",
                "users": [],
                "attributes": [
                    {
                        "id": 2,
                        "attribute": {
                            "id": 1,
                            "name": "Department",
                            "type": "select",
                            "options": [
                                "IT",
                                "HR",
                                "Marketing"
                            ]
                        },
                        "value": "Marketing"
                    }
                ]
            }
        ],
        "meta": {
            "total": 2,
            "per_page": 15,
            "current_page": 1,
            "last_page": 1
        },
        "links": {
            "first": "http://127.0.0.1:8000/api/projects?page=1",
            "last": "http://127.0.0.1:8000/api/projects?page=1",
            "prev": null,
            "next": null
        },
        "pages": [
            "http://127.0.0.1:8000/api/projects?page=1"
        ]
    },
    "message": "",
    "error": [],
    "status": 200
}
```

**Request with Operators:**
```http
GET /api/projects/2
```

**Response:**
```json
{
    "data": {
        "project": {
            "id": 2,
            "name": "Project Two",
            "status": "pending",
            "creator_id": 2,
            "creator_name": "Krima Mahmoud",
            "users": [],
            "attributes": [
                {
                    "id": 2,
                    "attribute": {
                        "id": 1,
                        "name": "Department",
                        "type": "select",
                        "options": [
                            "IT",
                            "HR",
                            "Marketing"
                        ]
                    },
                    "value": "Marketing"
                }
            ]
        }
    },
    "message": "",
    "error": [],
    "status": 200
}
```


## Test Credentials
Use these credentials to test the API:
```json
{
  "email": "modykrima2000@gmail.com",
  "password": "123456789"
}
```

---



