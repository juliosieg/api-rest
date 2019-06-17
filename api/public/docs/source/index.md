---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#General

APIs for cats data
<!-- START_e8df87899e3c464b1ccbf8d0a2412b8f -->
## Search by name

This function return information about the provided similar name cats

> Example request:

```bash
curl -X GET -G "/breeds" \
    -H "Content-Type: application/json" \
    -d '{"x-api-key":"1474c307-7ac9-4089-96e6-4988bd7dc046"}'

```
```javascript
const url = new URL("/breeds");

    let params = {
            "name": "si",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "x-api-key": "1474c307-7ac9-4089-96e6-4988bd7dc046"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[
    {
        "breeds": [
            {
                "weight": {
                    "imperial": "8 - 16",
                    "metric": "4 - 7"
                },
                "id": "sibe",
                "name": "Siberian",
                "cfa_url": "http:\/\/cfa.org\/Breeds\/BreedsSthruT\/Siberian.aspx",
                "vetstreet_url": "http:\/\/www.vetstreet.com\/cats\/siberian",
                "vcahospitals_url": "https:\/\/vcahospitals.com\/know-your-pet\/cat-breeds\/siberian",
                "temperament": "Curious, Intelligent, Loyal, Sweet, Agile, Playful, Affectionate",
                "origin": "Russia",
                "country_codes": "RU",
                "country_code": "RU",
                "description": "The Siberians dog like temperament and affection makes the ideal lap cat and will live quite happily indoors. Very agile and powerful, the Siberian cat can easily leap and reach high places, including the tops of refrigerators and even doors. ",
                "life_span": "12 - 15",
                "indoor": 0,
                "lap": 1,
                "alt_names": "Moscow Semi-longhair, HairSiberian Forest Cat",
                "adaptability": 5,
                "affection_level": 5,
                "child_friendly": 4,
                "dog_friendly": 5,
                "energy_level": 5,
                "grooming": 2,
                "health_issues": 2,
                "intelligence": 5,
                "shedding_level": 3,
                "social_needs": 4,
                "stranger_friendly": 3,
                "vocalisation": 1,
                "experimental": 0,
                "hairless": 0,
                "natural": 1,
                "rare": 0,
                "rex": 0,
                "suppressed_tail": 0,
                "short_legs": 0,
                "wikipedia_url": "https:\/\/en.wikipedia.org\/wiki\/Siberian_(cat)",
                "hypoallergenic": 1
            }
        ],
        "id": "qLPz9prjF",
        "url": "https:\/\/cdn2.thecatapi.com\/images\/qLPz9prjF.jpg",
        "width": 750,
        "height": 937
    }
]
```

### HTTP Request
`GET breeds`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    x-api-key | required |  optional  | Api Key.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  required  | Name of the cat to search.

<!-- END_e8df87899e3c464b1ccbf8d0a2412b8f -->

<!-- START_84e1bbe721bd43c7b6685773f3148b42 -->
## Search by id

This function return information about the provided id cat

> Example request:

```bash
curl -X GET -G "/breeds/1" 
```
```javascript
const url = new URL("/breeds/1");

    let params = {
            "id": "sibe",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[
    {
        "breeds": [
            {
                "weight": {
                    "imperial": "8 - 16",
                    "metric": "4 - 7"
                },
                "id": "sibe",
                "name": "Siberian",
                "cfa_url": "http:\/\/cfa.org\/Breeds\/BreedsSthruT\/Siberian.aspx",
                "vetstreet_url": "http:\/\/www.vetstreet.com\/cats\/siberian",
                "vcahospitals_url": "https:\/\/vcahospitals.com\/know-your-pet\/cat-breeds\/siberian",
                "temperament": "Curious, Intelligent, Loyal, Sweet, Agile, Playful, Affectionate",
                "origin": "Russia",
                "country_codes": "RU",
                "country_code": "RU",
                "description": "The Siberians dog like temperament and affection makes the ideal lap cat and will live quite happily indoors. Very agile and powerful, the Siberian cat can easily leap and reach high places, including the tops of refrigerators and even doors. ",
                "life_span": "12 - 15",
                "indoor": 0,
                "lap": 1,
                "alt_names": "Moscow Semi-longhair, HairSiberian Forest Cat",
                "adaptability": 5,
                "affection_level": 5,
                "child_friendly": 4,
                "dog_friendly": 5,
                "energy_level": 5,
                "grooming": 2,
                "health_issues": 2,
                "intelligence": 5,
                "shedding_level": 3,
                "social_needs": 4,
                "stranger_friendly": 3,
                "vocalisation": 1,
                "experimental": 0,
                "hairless": 0,
                "natural": 1,
                "rare": 0,
                "rex": 0,
                "suppressed_tail": 0,
                "short_legs": 0,
                "wikipedia_url": "https:\/\/en.wikipedia.org\/wiki\/Siberian_(cat)",
                "hypoallergenic": 1
            }
        ],
        "id": "qLPz9prjF",
        "url": "https:\/\/cdn2.thecatapi.com\/images\/qLPz9prjF.jpg",
        "width": 750,
        "height": 937
    }
]
```

### HTTP Request
`GET breeds/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  required  | Id of the cat to search.

<!-- END_84e1bbe721bd43c7b6685773f3148b42 -->


