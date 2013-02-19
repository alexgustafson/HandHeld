//
//  AssetDownloader.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 12.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "AssetDownloader.h"

@implementation AssetDownloader
@synthesize delegate;

- (id)init
{
    self = [super init];
    if (self) {
        
        hostAssetsURL = @"http://www.againstyou.net/handheld/deploy/";
        fileDownloadQueue = [[NSMutableArray alloc] init];
        
    }
    return self;
}

-(void)downloadDBFile
{
    
    NSURL *request = [NSURL URLWithString:@"http://www.againstyou.net/handheld/deploy/handheld.db"];
    
    NSData *urlData = [NSData dataWithContentsOfURL:request];
    if ( urlData )
    {
        NSArray   *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
        NSString  *documentsDirectory = [paths objectAtIndex:0];
        
        NSString  *filePath = [NSString stringWithFormat:@"%@/%@", documentsDirectory,@"handheld.db"];
        [urlData writeToFile:filePath atomically:YES];
        [delegate setDownloaderStatus:@"finishedDB"];
    }

}

-(void)downloadAssetList:(NSArray *)assetNameList
{
    [fileDownloadQueue addObjectsFromArray:assetNameList];
    if ([fileDownloadQueue count] > 0) {
        
        NSString* fileName = [fileDownloadQueue objectAtIndex:0];
        [fileDownloadQueue removeObjectAtIndex:0];
        
        
        NSArray *pathArr = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
        NSString *folder = [pathArr objectAtIndex:0];
        NSString *filePath = [folder stringByAppendingPathComponent:fileName];
                
        if (![[NSFileManager defaultManager] fileExistsAtPath:filePath]) {
            [[NSFileManager defaultManager] createFileAtPath:filePath contents:nil attributes:nil];
            
            
            NSMutableURLRequest *request = [[NSMutableURLRequest alloc]
                                            initWithURL:[NSURL
                                                         URLWithString:[NSString stringWithFormat:@"http://www.againstyou.net/handheld/deploy/%@", fileName]]];
            
            stream = [[NSOutputStream alloc] initToFileAtPath:filePath append:YES];
            [stream open];
            
            _connection_for_file_download = [[NSURLConnection alloc] initWithRequest:request delegate:self];
            
        }else{
            
            if ([fileDownloadQueue count] > 0) {
                [self downloadAssetList:NULL];
            }else{
                [delegate setDownloaderStatus:@"files downloaded"];
            }
            
            
        }

    }
    
}

-(void)downloadAssetListSynchronous:(NSMutableArray *)assetNameList
{
    for (NSString* fileName in assetNameList) {
        
        NSArray *pathArr = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
        NSString *folder = [pathArr objectAtIndex:0];
        NSString *filePath = [folder stringByAppendingPathComponent:fileName];
        
        NSURL *request = [NSURL URLWithString:[NSString stringWithFormat:@"http://www.againstyou.net/handheld/deploy/%@", fileName]];
        
        NSURLRequest *urlRequest = [NSURLRequest requestWithURL:request];
        NSURLResponse *response = nil;
        NSError *error = nil;
        [delegate createLoggerMessage:[NSString stringWithFormat:@"%@ downloading",fileName]];
        NSData *data = [NSURLConnection sendSynchronousRequest:urlRequest
                                                returningResponse:&response
                                                            error:&error];
        NSLog(@"url: %@", request);
        if ([data length] > 0 &&
            error == nil){
            NSLog(@"%lu bytes of data was returned.", (unsigned long)[data length]);
        }
        else if ([data length] == 0 &&
                 error == nil){
            NSLog(@"No data was returned.");
        }
        else if (error != nil){
            NSLog(@"Error happened = %@", error);
        }
        
        
        if ( data )
        {
            
            [data writeToFile:filePath atomically:YES];
            [delegate createLoggerMessage:[NSString stringWithFormat:@"%@ downloaded",fileName]];
        }
        
    }

}

-(void)downloadAsset:(NSString *)assetName andTargetPath:(NSString *) targetPath
{
    
}

-(void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response
{
    _responseData = [[NSMutableData alloc] init];
}

- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data
{
    //write to filesystem instead of keeping data in memory
    NSUInteger left = [data length];
    [stream write:[data bytes] maxLength:left];
    
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection
{
    
    [connection release];
    [_responseData release];
    
    if (connection == _connection_for_db_download) {
        [delegate setDownloaderStatus:@"finishedDB"];
        [delegate setDBPath:[localFileURL absoluteString]];
        
    }else if (connection == _connection_for_file_download)
    {
        [stream close];
        if ([fileDownloadQueue count] > 0) {
            [self downloadAssetList:NULL];
        }else{
           
        }
    }
    
}

@end
