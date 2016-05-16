<?php

namespace Task\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Task\Crawler\Crawl;
use Task\Logger\ReportLogger;
use Task\Notification\Email;
use Task\Notification\Sms;
use Task\Output\ReportTable;
use Task\Validator\Url;

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * WebsiteLoadTimeBenchmarkCommand class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class WebsiteLoadTimeBenchmarkCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('compare:websites')
            ->setDescription('Compare two websites (check how fast is the website\'s loading time in comparison to other competitors)')
            ->addArgument(
                'firstWebsite',
                InputArgument::REQUIRED,
                'First website URL (for example: "http://www.google.com")'
            )
            ->addArgument(
                'secondWebsites',
                InputArgument::IS_ARRAY,
                'Comma separated Second websites URLs (for example "http://www.php.net", "http://www.xsolve.pl")'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $firstWebsite = $input->getArgument('firstWebsite');
        $secondWebsites = $input->getArgument('secondWebsites');

        $urlValidator = new Url();

        if (!$urlValidator->validate($firstWebsite)) {
            $output->writeln('Incorrect "firstWebsite" URL.');
            exit(1);
        }

        if (!$urlValidator->validate($secondWebsites)) {
            $output->writeln('Incorrect "secondWebsites" URL.');
            exit(1);
        }

        $output->writeln(
            sprintf('<info>%s: Begin measuring...</info>', (new \DateTime())->format('Y-m-d H:m:s'))
        );

        $output->write(
            sprintf('Measure loading of first page "%s" url... ', $firstWebsite)
        );

        $crawl = new Crawl();

        if ($crawl->crawlUrl($firstWebsite) === true) {
            $output->writeln('<info>success</info>. ');
        } else {
            $output->writeln('<error>failed</error>. ');
            $output->writeln('<error>Could not continue, when first website could not be loaded.</error>');
            exit(1);
        }

        foreach ($secondWebsites as $url) {
            $output->write(
                sprintf('Compare first page with "%s" url... ', $url)
            );

            if ($crawl->crawlUrl($url) === true) {
                $output->writeln('<info>success</info>. ');
            } else {
                $output->writeln('<error>Website was not loaded. Ignoring.</error>');
            }
        }

        $report = $crawl->getReport();

        $output->writeln('<info>Done. Your report: </info>');

        /// print results into Output as nice table
        $reportTable = new ReportTable($output);
        $reportTable->render($report);

        // log results into logger
        $reportLogger = new ReportLogger('command:'.$this->getName());
        $reportLogger->dump($report);

        // print who are faster url
        $fastest = $report->getFastest();
        $output->writeln(
            sprintf('And the winner is: "<info>%s</info>" website. ', $fastest->getUrl())
        );

        $first = $report->getFirst();

        if ($fastest != $first) {
            $fastest = $fastest;
            $output->writeln(
                'Send e-mail.. '
            );

            $messageBody = sprintf(
                'Site "%s" is %d ms faster than site "%s".',
                $fastest->getUrl(),
                $fastest->subtractExecutionTime($first),
                $first->getUrl()
            );
            $email = new Email();
            $email->send('Found faster website', $messageBody);

            if ($fastest->divideExecutionTime($first) >= 2) {
                $sms = new Sms();
                $sms->send('Found website twice faster', $messageBody);
            }
        }

        $output->writeln(
            sprintf('<info>%s: Finished.</info>', (new \DateTime())->format('Y-m-d H:m:s'))
        );
    }
}
