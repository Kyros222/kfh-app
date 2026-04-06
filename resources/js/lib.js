export async function getYmaps3Modules() {
    const ymaps3 = window.ymaps3;
    if (!ymaps3?.ready) {
        throw new Error(
            "ymaps3 не загружен: подключите скрипт api-maps.yandex.ru до contact.js"
        );
    }

    await ymaps3.ready;

    const { YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker } =
        ymaps3;
    return {
        YMap,
        YMapDefaultSchemeLayer,
        YMapDefaultFeaturesLayer,
        YMapMarker,
    };
}
