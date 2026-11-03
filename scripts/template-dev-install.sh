#!/usr/bin/env bash
# Install Composer deps while developing this GitHub *template* (not a Packagist package).
# Spatie-style composer.json uses an invalid placeholder name until configure.php runs.
set -euo pipefail
cd "$(dirname "$0")/.."

fixture_name="${TEMPLATE_DEV_NAME:-inengine/skeleton-dev}"
backup="$(mktemp)"
cp composer.json "$backup"
restore() { cp "$backup" composer.json; rm -f "$backup"; }
trap restore EXIT

if grep -q '":vendor_slug/:package_slug"' composer.json; then
  perl -pi -e "s#\":vendor_slug/:package_slug\"#\"${fixture_name}\"#g" composer.json
fi

composer update --prefer-dist --no-interaction "$@"
