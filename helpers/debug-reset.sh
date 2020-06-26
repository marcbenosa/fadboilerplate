# to run: bash debug-reset.sh
for d in */ ; do
(cd "$d" &&
wp config set --raw WP_DEBUG true &&
wp config set --raw WP_DEBUG_LOG true &&
wp config set --raw WP_DEBUG_DISPLAY false);
done
