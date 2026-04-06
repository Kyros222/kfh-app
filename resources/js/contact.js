import { getYmaps3Modules } from "./lib.js";

/** Запрос для поиска точки на карте (как в доке: init-map-by-geocoding) */
const ADDRESS_QUERY =
    "Россия, Тульская область, г. Новомосковск, ул. Трудовые Резервы, 33А";

/** Запасные координаты, если поиск не вернёт результат — [долгота, широта] */
const ADDRESS_FALLBACK = [38.287284, 54.016982];

function createPinElement() {
    const root = document.createElement("div");
    root.className = "yandex-map-pin";
    root.setAttribute(
        "title",
        "KHODAKOV FASHION HOUSE — г. Новомосковск, ул. Трудовые Резервы, 33А"
    );
    root.innerHTML = `
        <svg class="yandex-map-pin__svg" viewBox="0 0 48 56" width="48" height="56" aria-hidden="true">
            <path fill="rgba(126, 176, 239, 1)" stroke="#ffffff" stroke-width="3"
                d="M24 4C14 4 6 12 6 22c0 14 18 30 18 30s18-16 18-30c0-10-8-18-18-18z"/>
            <circle cx="24" cy="21" r="6" fill="#ffffff"/>
        </svg>
    `;
    return root;
}

async function initMap() {
    const container = document.getElementById("app");
    if (!container) return;

    const {
        YMap,
        YMapDefaultSchemeLayer,
        YMapDefaultFeaturesLayer,
        YMapMarker,
    } = await getYmaps3Modules();

    let addressCoords = ADDRESS_FALLBACK;
    try {
        const search = await window.ymaps3.search({ text: ADDRESS_QUERY });
        if (search.length && search[0].geometry?.coordinates) {
            addressCoords = search[0].geometry.coordinates;
        }
    } catch (e) {
        // eslint-disable-next-line no-console
        console.warn("[contact.js] Геокодирование адреса:", e);
    }

    const map = new YMap(
        container,
        {
            location: {
                center: addressCoords,
                zoom: 17,
            },
            showScaleInCopyrights: true,
        },
        [
            new YMapDefaultSchemeLayer({
                customization: [
                    {
                        tags: { all: ["water"] },
                        elements: "geometry",
                        stylers: [{ color: "#c8dff8", opacity: 0.92 }],
                    },
                    {
                        tags: { all: ["park"] },
                        elements: "geometry",
                        stylers: [{ color: "#e6f2ea" }],
                    },
                ],
            }),
            new YMapDefaultFeaturesLayer({}),
        ]
    );

    const pinEl = createPinElement();
    const marker = new YMapMarker(
        {
            coordinates: addressCoords,
        },
        pinEl
    );
    map.addChild(marker);
}

initMap();
